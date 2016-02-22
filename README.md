# API Lord of the Ring

## The team

* Lucas Lemahieu
* Jean Law Yim Wan
* Magali Rivière
* Alexis Subias
* Louis Piechowiak


## Context

This API allows you to get informations about characters, places and events of Lord of the Ring:
* Characters' names and races
* Events & places positions
* Map
* ...

**Example:** what did Frodon between the Council of Elrond and 3019, 03. 25 ?

```
> http://127.0.0.1:8000/character/frodon/period/conseil-elrond/3019-03-25
```

It will return something like that:

```javascript
[
  {
    "id": 401,
    "character": {
      "id": 3,
      "slug": "frodon",
      "name": "Frodon Sacquet",
      "race": {
        "id": 3,
        "slug": "hobbit",
        "description": "Egalement appelés Semi-hommes ou Periannath."
      }
    },
    "date": "3018-10-25T00:00:00+0100",
    "coordx": 41,
    "coordy": 26,
    "status": {
      "id": 1,
      "slug": "Bonne santé"
    }
  },
  {
    "id": 402,
    "character": {
      "id": 3,
      "slug": "frodon",
      "name": "Frodon Sacquet",
      "race": {
        "id": 3,
        "slug": "hobbit",
        "description": "Egalement appelés Semi-hommes ou Periannath."
      }
    },
    ...
  ]
```


## Local installation

**1. Clone the repo and install the dependencies**

```sh
$ git clone https://github.com/LucasChat/api-lotr.git
$ cd api-lotr
$ composer install
```

**2. Import the database**

Before importing the sql file, make sure you don't have a databse called **api-lotr** because the importation will create the database for you.

**3. Check if PHP GD2 is activate to turn on png**

> [PHP GD2 installation](http://php.net/manual/en/image.installation.php)

**4. Launch the server**

```sh
$ php app/console server:run
```

It will show you this message, you can access to the api!

```sh
$ [OK] Server running on http://127.0.0.1:8000 
```

127.0.0.1:8000 is the default uri, you can change it if you want

## Routes

### Single characters

```sh
> GET /character/{slug}
> GET /character/{slug}/date/{date}
> GET /character/{slug}/place/{place}
> GET /character/{slug}/place/{place}/date/{date}
> GET /character/{slug}/period/{date1}/{date2}
> GET /character/{slug}/place/{place}/period/{date1}/{date2}
> GET /character/{slug}/event/{event}/position
> GET /character/{slug}/event/{event}/present
```

### Multi character

```sh
> GET /characters
> GET /characters/date/{date}
> GET /characters/period/{date1}/{date2}
```

### Places

```sh
> GET /places
> GET /place/{slug}
> GET /place/{slug}/characters
> GET /place/{slug}/characters/date/{date}
> GET /place/{slug}/characters/period/{date1}/{date2}
```

### Events

```sh
> GET /events
> GET /event/{slug}
> GET /event/{slug}/position/characters
> GET /event/{slug}/present/characters
```

### Map

```sh
> GET /map
```

## License

Code released under the MIT license