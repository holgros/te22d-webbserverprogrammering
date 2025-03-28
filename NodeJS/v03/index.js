let app = require("express")();
app.listen(3000);
console.log("Servern körs på port 3000");

// börja med att returnera ett hårdkodat objekt
let users = [
  {
    id: 0,
    firstname: "Holger",
    lastname: "Rosencrantz",
  },
  {
    id: 1,
    firstname: "Kalle",
    lastname: "Anka",
  },
  { id: 2, firstname: "Java", lastname: "Script" },
];

app.get("/", function (req, res) {
  res.sendFile(__dirname + "/dokumentation.html");
});

app.get("/users", function (req, res) {
  //res.send(users);
  console.log(req.query); // skriver ut query-parametrar på konsolen
  if (Object.keys(req.query).length == 0) {
    // kolla om objektet är tomt
    res.send(users); // skicka hela tabellen
    return; // avsluta funktionen utan att ytterligare processa query-parametrar
  }
  // processa query-parametrar
  let output = [];
  for (let i = 0; i < users.length; i++) {
    // loopa igenom users
    let match = true;
    // antag först match=true
    for (let key in req.query) {
      // loopa igenom attribut
      if (users[i][key] != req.query[key]) {
        // om något attributvärde *inte* matchar så ändra till false och bryt
        match = false;
        break;
      }
    }
    // lägg till i resultatet ifall vi har en matchning
    if (match) {
      output.push(users[i]);
    }
  }
  res.send(output);
});

// processa route-parametrar
app.get("/users/:id", function (req, res) {
  console.log(req.params);
  // processa route-parametrar på liknande sätt som ovan, dvs. filtrera vårt hårdkodade objekt
  for (let i = 0; i < users.length; i++) {
    // loopa genom fältet users
    if (users[i].id == req.params.id) {
      res.send(users[i]); // returnera user med rätt ID
      return; // avsluta funktionen
    }
  }
  res.sendStatus(404); // 404 = not found, om man inte har hittat någon matchning
});
