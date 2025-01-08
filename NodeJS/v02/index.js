// starta en webbserver - likadant som tidigare exempel
let express = require("express");
let app = express();
let port = 8080;
let httpServer = app.listen(port, function () {
  console.log(`Webbserver körs på port ${port}`);
});
app.get("/", function (req, res) {
  res.sendFile(__dirname + "/chattrobot.html");
});

// läs in html-mallen med file server
let fs = require("fs");
let html = "";
fs.readFile("chattrobot.html", function (err, data) {
  html = data.toString();
});

// hantera svar från chattrobot
app.get("/chat", function (req, res) {
  let input = req.query.input;
  let output = läsFrånDatabas(input);
  res.send(
    html.replace(`<div id="output"></div>`, `<div id="output">${output}</div>`)
  );
});

// TODO: implementera funktionen
let läsFrånDatabas = function (input) {
  // Skriv kod här...
  let response = "TODO, TODO...";
  // När du har läst in svaret så returnerar du det
  return `<p>Du skrev: ${input}</p>
    <p>Databasen svarar: ${response}`;
};
