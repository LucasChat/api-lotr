# API Lord of the Ring

## The team

* Lucas Lemahieu
* Jean Law Yim Wan
* Magali Rivière
* Alexis Subias
* Louis Piechowiak

## Demonstration

You can test this API at this address : [http://api-lotr.jean-lawyimwan.fr/](http://api-lotr.jean-lawyimwan.fr/)

## Context

This API based on Symfony 2.8 allows you to get informations about characters, places and events of Lord of the Ring:
* Characters' names and races
* Events & places positions
* Map
* ...

**The api only returns data between 3018-09-23 and 3019-03-25**

**Example:** what did Frodon between the Council of Elrond and 3019-03-25 ?

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

At the end of the installation, you have to enter some informations about the databased used:

* **database_host:** 127.0.0.1
* **database_port:** null by default or your database port
* **database_name:** api-lotr
* **datable_user:** root by default
* **datable_password:** root by default for Mac users or null by default for Windows users

For the other parameters, just press ***enter*** to use the default configuration.

**2. Import the database**

Before importing the sql file, make sure you don't have a databse called **api-lotr** because the importation will create the database for you.

The sql file is in this folder: **api-lotr/src/LotrBundle/Resources/sql/**

**3. Check if PHP GD2 is activate to turn on png**

> [PHP GD2 installation](http://php.net/manual/en/image.installation.php)

**4. Launch the server**

```sh
$ php app/console server:run
```

It will show you this message:

```sh
$ [OK] Server running on http://127.0.0.1:8000 
```

You can now use the api.

127.0.0.1:8000 is the default uri, you can change it if you want

## Databse schema

![Databse Schema](http://jean-lawyimwan.fr/img/Schema_bdd_api_lotr.png)

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

### Multi characters

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

#### Get the basic map

```sh
> GET /map
````

#### Available routes with map render

```sh
> GET /character/{slug}/date/{date}.png
> GET /character/{slug}/place/{place}.png
> GET /character/{slug}/place/{place}/date/{date}.png
> GET /character/{slug}/period/{date1}/{date2}.png
> GET /character/{slug}/place/{place}/period/{date1}/{date2}.png
> GET /character/{slug}/event/{event}/position.png
> GET /character/{slug}/event/{event}/present.png

> GET /events.png
> GET /event/{slug}.png

> GET /places.png
> GET /place/{slug}.png
```

#### Map types

By default, the API returns the **0-type map** but you can change it by incrementing the type value.

* **type=0** -> no legend, no numbering, no grid
* **type=1** -> [legend], no numbering, no grid
* **type=2** -> no legend, [numbering], no grid
* **type=3** -> no legend, [numbering], [grid]
* **type=4** -> [legend], [numbering], no grid
* **type=5** -> [legend], [numbering], [grid]

**Examples**

```sh
> GET /map?type=5
> GET /character/{slug}/period/{date1}/{date2}.png?type=3
```

## License

Code released under the MIT license
