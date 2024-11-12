<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ULID Generator</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f4f7;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            margin-bottom: 8px;
            color: #555;
        }

        input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .ulid-list {
            list-style: none;
            padding: 0;
        }

        .ulid-item {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 8px;
            border-left: 4px solid #4CAF50;
            word-break: break-all;
            font-family: monospace;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .copy-button {
            background-color: #008CBA;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .copy-button:hover {
            background-color: #007B9E;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            button,
            .copy-button {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>ULID Generator</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ULID Generation Form -->
        <form method="POST" action="{{ route('ulid.generate') }}">
            @csrf
            <label for="count">Number of ULIDs to generate (1-100):</label>
            <input type="number" id="count" name="count" min="1" max="100"
                value="{{ old('count', 1) }}">
            <button type="submit">Generate</button>
        </form>

        <!-- Display Generated ULIDs -->
        @if (!empty($ulids))
            <h2>Generated ULID{{ count($ulids) > 1 ? 's' : '' }}:</h2>
            <ul class="ulid-list">
                @foreach ($ulids as $ulid)
                    <li class="ulid-item">
                        <span>{{ $ulid }}</span>
                        <button class="copy-button" onclick="copyToClipboard('{{ $ulid }}')">Copy</button>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <script>
        /**
         * Copies the provided text to the clipboard.
         * @param {string} text - The text to copy.
         */
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('ULID copied to clipboard');
            }, function(err) {
                alert('Failed to copy ULID');
            });
        }
    </script>
</body>

</html>
