const express = require('express');
const { exec } = require('child_process');
const app = express();
const port = process.env.PORT || 3000;

// Serve static files from public directory
app.use(express.static('public'));

// Proxy requests to PHP files
app.all('/*.php', (req, res) => {
    const phpFile = req.path;
    exec(`php ${process.cwd()}/public${phpFile}`, (error, stdout, stderr) => {
        if (error) {
            res.status(500).send(`Error executing PHP: ${stderr}`);
            return;
        }
        res.send(stdout);
    });
});

// Default route to index.php
app.get('/', (req, res) => {
    exec(`php ${process.cwd()}/public/index.php`, (error, stdout, stderr) => {
        if (error) {
            res.status(500).send(`Error executing PHP: ${stderr}`);
            return;
        }
        res.send(stdout);
    });
});

app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});