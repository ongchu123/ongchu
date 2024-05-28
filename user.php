<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Command Lookup Tool - User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Command Lookup Tool</h1>
    </header>

    <div class="container">
        <aside id="resultsBox">
            <h2>Search Results</h2>
            <div id="results"></div>
        </aside>

        <main>
            <section id="search">
                <h2>Search Commands</h2>
                <form id="searchForm">
                    <input type="text" id="command" name="command" placeholder="Enter command">
                    <button type="submit">Search</button>
                </form>
                <div id="searchDetails">
                    <p>Details about the command will be displayed here.</p>
                </div>
            </section>

            <section id="suggestions">
                <h2>Suggest a New Command</h2>
                <form id="suggestionForm">
                    <input type="text" id="newCommand" name="newCommand" placeholder="New command">
                    <textarea id="description" name="description" placeholder="Command description"></textarea>
                    <button type="submit">Submit</button>
                </form>
                <div id="suggestionResult"></div>
            </section>
        </main>
    </div>

    <footer>
        <p>Contact us at info@commandlookup.com</p>
        <p>&copy; 2024 Command Lookup Tool</p>
    </footer>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let command = document.getElementById('command').value;

            fetch('commands.php?action=lookup&command=' + encodeURIComponent(command))
                .then(response => response.json())
                .then(data => {
                    let resultsDiv = document.getElementById('results');
                    if (data.success) {
                        resultsDiv.innerHTML = `<p><strong>${command}</strong>: ${data.description}</p>`;
                    } else {
                        resultsDiv.innerHTML = `<p>No results found for "${command}".</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        document.getElementById('suggestionForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let newCommand = document.getElementById('newCommand').value;
            let description = document.getElementById('description').value;

            fetch('commands.php?action=add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ command: newCommand, description: description })
            })
            .then(response => response.json())
            .then(data => {
                let suggestionResultDiv = document.getElementById('suggestionResult');
                if (data.success) {
                    suggestionResultDiv.innerHTML = `<p>Suggestion submitted successfully!</p>`;
                } else {
                    suggestionResultDiv.innerHTML = `<p>There was an error submitting your suggestion. Please try again.</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
