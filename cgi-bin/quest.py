#вывод в таблицу

import cgi, sys
form = cgi.FieldStorage()         # извлечь данные из формы
print("Content­type: text/html")  # плюс пустая строка

html1 = """
<TITLE>Таблица с анкетой</TITLE>
<H1>Анкета пользователя</H1>
<table border =2> <tr>  <td>Имя поля</td><td>Значение</td>  </tr>
"""

# печать заголовка таблицы
print (html1)


ll = ['имя','размер обуви','должность', 'Любимый язык программирования','комментарий']

data = ['','','','','']; i=0
for field in ('name', 'shoesize', 'job', 'language', 'comment'):
    if not field in form:
        data[i] = '(unknown)'
    else:

        if not isinstance(form[field], list):
            data[i] = form[field].value
        else:
            values = [x.value for x in form[field]]
            data[i] = ', '.join(values)
    i+=1

for i in range(5):
   print ('<tr><td> %s </td> <td> %s </td></tr>'% (ll[i], data[i]))

print (' </table>')