<html>
    <body>
        <h1>API Endpoints</h1>
        <ul>
            <li>
            POST /register
                <ul>
                    <li>username : string</li>
                    <li>password : string</li>
                </ul>
            </li>
            <li>
            POST /login
                <ul>
                    <li>username : string</li>
                    <li>password : string</li>
                </ul>
            </li>
            <li>
            POST /save
                <ul>
                    <li>player : string</li>
                    <li>flip_count : int</li>
                    <li>api_key : string</li>
                </ul>
            </li>
            <li>
            POST /history
                <ul>
                    <li>player : string</li>
                    <li>api_key : string</li>
                </ul>
            </li>
        </ul>
    </body>
</html>