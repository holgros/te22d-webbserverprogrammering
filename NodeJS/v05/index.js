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

app.use(express.json()); // för att läsa data från klient och för att skicka svar (ersätter bodyparser som vi använt någon gång tidigare)

app.post("/users", function (req, res) {
  // kod för att validera input
  if (!req.body.userId) {
    res.status(400).send("userId required!");
    return; // avslutar metoden
  }
  let fields = ["firstname", "lastname", "userId", "passwd"]; // ändra eventuellt till namn på er egen databastabells kolumner
  for (let key in req.body) {
    if (!fields.includes(key)) {
      res.status(400).send("Unknown field: " + key);
      return; // avslutar metoden
    }
  }
  // kod för att hantera anrop
  let sql = `INSERT INTO users (firstname, lastname, userId, passwd)
    VALUES ('${req.body.firstname}', 
    '${req.body.lastname}',
    '${req.body.userId}',
    '${req.body.passwd}');`;
  console.log(sql);

  con.query(sql, function (err, result, fields) {
    if (err) throw err;
    // kod för att hantera retur av data
    console.log(result);
    let output = {
      id: result.insertId,
      firstname: req.body.firstname,
      lastname: req.body.lastname,
      userId: req.body.userId,
      passwd: req.body.passwd,
    };
    res.send(output);
  });
});
