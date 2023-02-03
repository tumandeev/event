# Event

## Installation

Для работы на машине требуется Docker и Docker-compose и ssh

Процесс установки

```sh
git clone git@github.com:tumandeev/event.git
```
Из корня проекта:
```sh
docker-compose up -d --build
```

Если все установлено верно, то можно будет работать с проектом по адресам:
```sh
Само приложение - 127.0.0.1:8000
База данных - 127.0.0.1:8888
```