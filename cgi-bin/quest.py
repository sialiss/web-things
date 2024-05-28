import cgi
import os
import cgitb
import urllib.parse

cgitb.enable()  # for debugging

# Getting data from the query string
query_string = os.environ.get('QUERY_STRING', '')
query_params = urllib.parse.parse_qs(query_string)

print("Content-type: text/html\n")  # plus a blank line

html1 = """
<!DOCTYPE html>
<html>
<head>
    <title>Анкета пользователя</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        img {
            max-width: 250px;
            height: auto;
        }
    </style>
    <script>
        function validateForm() {
            let name = document.forms["userForm"]["name"].value;
            let surname = document.forms["userForm"]["surname"].value;
            let patronymic = document.forms["userForm"]["patronymic"].value;
            let gender = document.forms["userForm"]["gender"].value;
            let favoriteAnime = document.forms["userForm"]["favorite_anime"].value;
            let favoriteStudio = document.forms["userForm"]["favorite_studio"].value;
            let genres = document.forms["userForm"]["genres"].value;
            let comment = document.forms["userForm"]["comment"].value;

            if (name == "" || surname == "" || patronymic == "" || gender == "" || favoriteAnime == "" || favoriteStudio == "" || genres == "" || comment == "") {
                alert("Все поля должны быть заполнены");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Анкета пользователя</h1>
    <form name="userForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
        <table>
            <tr><th>Имя поля</th><th>Значение</th></tr>
"""

# Printing the table header
print(html1)

# Define field names and labels
field_labels = ['Имя', 'Фамилия', 'Отчество', 'Пол', 'Любимое аниме', 'Любимая студия анимации', 'Любимые жанры аниме', 'Комментарий']
fields = ['name', 'surname', 'patronymic', 'gender', 'favorite_anime', 'favorite_studio', 'genres', 'comment']
data = []

for field in fields:
    if field not in query_params:
        data.append('(unknown)')
    else:
        if not isinstance(query_params[field], list):
            data.append(urllib.parse.unquote(query_params[field][0]))
        else:
            values = [urllib.parse.unquote(x) for x in query_params[field]]
            data.append(', '.join(values))

# Print table rows
for i in range(len(fields)):
    print(f'<tr><td>{field_labels[i]}</td><td>{data[i]}</td></tr>')

# Save uploaded image and display
upload_dir = './uploads'
if not os.path.exists(upload_dir):
    os.makedirs(upload_dir)

form = cgi.FieldStorage()
print('<tr><td>Изображение</td><td>')

if form['character_image'].value:
    print(f'{form["character_image"].value}</td></tr>')
else:
    print('Изображение не было загружено</td></tr>')

print('</table></form></body></html>')
