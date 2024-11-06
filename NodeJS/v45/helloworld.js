var http = require("http");

http
  .createServer(function (req, res) {
    res.writeHead(200, { "Content-Type": "text/plain" });
    res.end("Hello World!");
  })
  .listen(8080);

console.log(
  "Webbserver lyssnar på port 8080. Öppna i webbläsaren på localhost:8080. Avsluta i kommandotolken med ctrl-C."
);
