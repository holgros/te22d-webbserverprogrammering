let express = require("express"); // INSTALLERA MED "npm install express" I KOMMANDOTOLKEN
let app = express();
app.listen(3000);
console.log("Servern körs på port 3000");

app.get("/", function (req, res) {
  res.sendFile(__dirname + "/dokumentation.html");
});

const mysql = require("mysql"); // INSTALLERA MED "npm install mysql" I KOMMANDOTOLKEN
con = mysql.createConnection({
  host: "localhost", // databas-serverns IP-adress
  user: "root", // standardanvändarnamn för XAMPP
  password: "", // standardlösenord för XAMPP
  database: "webbserverprogrammering", // ÄNDRA TILL NAMN PÅ ER EGEN DATABAS
});

app.use(express.json());

const bcrypt = require("bcryptjs");
app.post("/users", async function (req, res) {
  // OBS: "async"!
  if (!req.body.userId) {
    res.status(400).send("userId required!");
    return;
  }
  let fields = ["firstname", "lastname", "userId", "passwd"]; // ändra eventuellt till namn på er egen databastabells kolumner
  for (let key in req.body) {
    if (!fields.includes(key)) {
      res.status(400).send("Unknown field: " + key);
      return;
    }
  }
  const salt = await bcrypt.genSalt(10); // genererar ett salt till hashning
  const hashedPassword = await bcrypt.hash(req.body.passwd, salt); //hashar lösenordet
  // OBS: näst sista raden i SQL-satsen står det "hashedPassword"
  // Det hashade lösenordet kan ha över 50 tecken, så använd t.ex. typen VARCHAR(100) i databasen, annars riskerar det hashade lösenordet att trunkeras (klippas av i slutet)
  let sql = `INSERT INTO users (firstname, lastname, userId, passwd)
    VALUES ('${req.body.firstname}', 
    '${req.body.lastname}',
    '${req.body.userId}',
    '${hashedPassword}')`;
  console.log(sql);

  con.query(sql, function (err, result, fields) {
    if (err) throw err;
    console.log(result);
    let output = {
      id: result.insertId,
      firstname: req.body.firstname,
      lastname: req.body.lastname,
      userId: req.body.userId,
    }; // OBS: bäst att INTE returnera lösenordet
    res.send(output);
  });
});

app.post("/login", function (req, res) {
  //kod här för att hantera anrop…
  let sql = `SELECT * FROM users WHERE userId='${req.body.userId}'`;

  con.query(sql, async function (err, result, fields) {
    // OBS: "async"!
    if (err) throw err;
    if (result.length == 0) {
      res.sendStatus(401);
      return;
    }
    // Verifiera hash med bcrypt
    const isPasswordValid = await bcrypt.compare(
      req.body.passwd, // password sent from user
      result[0].passwd // password from database
    );

    if (isPasswordValid) {
      // Skicka info om användaren, utan känslig info som t.ex. hash
      res.send({
        // OBS: returnera inte passwd!
        firstname: result[0].firstname,
        lastname: result[0].lastname,
        userId: result[0].userId,
      });
    } else {
      // Skicka felmeddelande
      res.status(401).json({ error: "Invalid credentials" });
    }
  });
});
