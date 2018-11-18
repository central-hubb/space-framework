let app = require('http').createServer(handler);
let io = require('socket.io')(app);
let fs = require('fs');

app.listen(3000);

function handler (req, res) {
    fs.readFile(__dirname + '/index.html',
        function (err, data) {
            if (err) {
                res.writeHead(500);
                return res.end('Error loading index.html');
            }

            res.writeHead(200);
            res.end(data);
        });
}

io.on('connection', function (socket) {

    socket.emit('stc-channel-1', {'hello' : 'world'});

    socket.on('cts-channel-1', function (data) {
        console.log(data);
    });
});