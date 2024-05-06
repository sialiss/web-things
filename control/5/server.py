from http.server import BaseHTTPRequestHandler, HTTPServer
from urllib.parse import parse_qs
import cgi

class RequestHandler(BaseHTTPRequestHandler):
    def do_POST(self):
        form = cgi.FieldStorage(
            fp=self.rfile,
            headers=self.headers,
            environ={'REQUEST_METHOD': 'POST',
                     'CONTENT_TYPE': self.headers['Content-Type'],}
        )

        num1 = int(form.getvalue('num1'))
        num2 = int(form.getvalue('num2'))
        operator = form.getvalue('operator')
        result = self.calculate(num1, num2, operator)

        print(f"Выполнен POST-запрос с данными: num1={num1}, num2={num2}, operator={operator}, результат={result}")

        self.send_response(200)
        self.send_header('Content-type', 'text/plain')
        self.end_headers()
        self.wfile.write(str(result).encode())

    def calculate(self, num1, num2, operator):
        if operator == '+':
            return num1 + num2
        elif operator == '-':
            return num1 - num2
        elif operator == '*':
            return num1 * num2
        elif operator == '/':
            if num2 != 0:
                return num1 / num2
            else:
                return "Ошибка: деление на ноль"

    # def do_GET(self):
    #     if self.path == '/favicon.ico':
    #         with open('favicon.ico', 'rb') as f:
    #             self.send_response(200)
    #             self.send_header('Content-type', 'image/x-icon')
    #             self.end_headers()
    #             self.wfile.write(f.read())
    #     else:
    #         self.send_error(404, 'File Not Found: %s' % self.path)

    def do_GET(self):
        if self.path == '/':
            self.send_response(200)
            self.send_header('Content-type', 'text/html')
            self.end_headers()
            with open('index.html', 'rb') as f:
                self.wfile.write(f.read())
        else:
            self.send_error(404, 'File Not Found: %s' % self.path)

                


def run(server_class=HTTPServer, handler_class=RequestHandler, port=8000):
    server_address = ('', port)
    httpd = server_class(server_address, handler_class)
    print(f'Запуск сервера на порту {port}...')
    httpd.serve_forever()

if __name__ == "__main__":
    run()
