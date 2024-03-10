<!DOCTYPE html>
<html>
<head>
    <title>Upload and Save Data</title>
    <link rel="stylesheet" href="style/addCSV.style.css">
    <style>
        
    </style>
</head>
<body>
    <div class="upload-form">
        <h1>Upload a CSV file</h1>
        <form action="processCSV.php" method="post" enctype="multipart/form-data">
            <label for="fileToUpload">Select a CSV file:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload File" name="submit">
        </form>
    </div>
</body>
</html>
