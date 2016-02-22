# API Lord of the Ring
## The team
* Lucas Lemahieu
* Jean Law Yim Wan
* Magali Rivière
* Alexis Subias
* Louis Piechowiak
## Context
Some text
## Installation
Some text
## Use the API - Routing
### Characters
***
#### Get all characters
```
> 127.0.0.1:8000/characters
```
This route will return something like that:
```javascript
[
  {
    "id": 1,
    "slug": "aragorn",
    "name": "Aragorn, dit Grands-Pas",
    "race": {
      "id": 1,
      "slug": "homme",
      "description": "L'humanité, race jeune en opposition aux autres races humanoïdes telles les Elfes, les Nains ou les Orques."
    }
  },
  {
    "id": 2,
    "slug": "boromir",
    "name": "Boromir, fils de Denethor",
    "race": {
      "id": 1,
      "slug": "homme",
      "description": "L'humanité, race jeune en opposition aux autres races humanoïdes telles les Elfes, les Nains ou les Orques."
    }
  },
  ...
 ]
```
#### Get one character
```
> 127.0.0.1:8000/character/{slug}
```
> 127.0.0.1:8000/character/frodon

Taking the example of Frodon, it'll return:
```javascript
[
  {
    "id": 3,
    "slug": "frodon",
    "name": "Frodon Sacquet",
    "race": {
      "id": 3,
      "slug": "hobbit",
      "description": "Egalement appelés Semi-hommes ou Periannath."
    }
  }
]
```
#### Looking about what did a character at a particular date
```
> 127.0.0.1:8000/character/{slug}/date/{date}
```
Assuming we want informations of what did Gandalf on 3018, 09. 28, we'll access to:
> 127.0.0.1:8000/character/gandalf/date/3018-09-28

It will return:
```javascript
[
  {
    "id": 558,
    "character": {
      "id": 4,
      "slug": "gandalf",
      "name": "Gandalf le gris, puis Gandalf le blanc",
      "race": {
        "id": 4,
        "slug": "maia",
        "description": "Ils font partie des Ainur, les divinités issues de l'esprit d'Ilúvatar, le dieu créateur."
      }
    },
    "date": "3018-09-28T00:00:00+0100",
    "coordx": 22,
    "coordy": 32,
    "status": {
      "id": 1,
      "slug": "Bonne santé"
    }
  }
]
```
#### Get character's informations during a period
```
> 127.0.0.1:8000/character/{slug}/period/{event}/{date}
```
> 127.0.0.1:8000/character/frodon/period/conseil-elrond/3019-09-28

It will return:
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
    "date": "3018-10-26T00:00:00+0100",
    "coordx": 41,
    "coordy": 26,
    "status": {
      "id": 1,
      "slug": "Bonne santé"
    }
  },
  ...
]
```
#### Check if a character is moved to a place
```
> 127.0.0.1:8000/character/{slug}/place/{slug}
```
Assuming we want to check if Frodon went to Moria and get the dates he went to:
> 127.0.0.1:8000/character/frodon/place/moria

```javascript
[
  [
    {
      "id": 5,
      "slug": "moria",
      "name": "Moria",
      "coordx": 41,
      "coordy": 35
    }
  ],
  [
    {
      "id": 481,
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
      "date": "3019-01-13T00:00:00+0100",
      "coordx": 41,
      "coordy": 35,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    },
    ...
  ]
]
```
#### Checking if a character was in a place at a specific date
```
> 127.0.0.1:8000/character/{slug}/place/{slug}/date/{date}
```
> 127.0.0.1:8000/character/frodon/place/moria/date/3019-01-15

We'll obtain this result:
```javascript
[
  [
    {
      "id": 5,
      "slug": "moria",
      "name": "Moria",
      "coordx": 41,
      "coordy": 35
    }
  ],
  [
    {
      "id": 483,
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
      "date": "3019-01-15T00:00:00+0100",
      "coordx": 41,
      "coordy": 35,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    }
  ]
]
```
If Frodon wasn't here at this date, the API will return something like that:
```javascript
[
  [
    {
      "id": 5,
      "slug": "moria",
      "name": "Moria",
      "coordx": 41,
      "coordy": 35
    }
  ],
  "error : frodon wasn't here at this date"
]
```
#### Checking if a character was in a place during a period
```
> 127.0.0.1:8000/character/{slug}/place/{slug}/period/{date}/{event}
```
> 127.0.0.1:8000/character/frodon/place/moria/period/3019-01-12/bataille-gouffre-helm

The result will be as the same as seen previously, even with the error message if no result matches.
#### Get a character's position(s) during an event
```
> 127.0.0.1:8000/character/{slug}/event/{event}/position
```
> 127.0.0.1:8000/character/frodon/event/bataille-gouffre-helm/position

This example returns all the positions of Frodon during the Battle of Helm's Deep
```javascript
[
  [
    {
      "id": 25,
      "slug": "bataille-gouffre-helm",
      "name": "Bataille du Gouffre de Helm. / Bataille de Fort-le-Cor",
      "date": "3019-03-03T00:00:00+0100",
      "date_end": "3019-03-04T00:00:00+0100",
      "coordx": 38,
      "coordy": 52
    }
  ],
  [
    {
      "id": 530,
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
      "date": "3019-03-03T00:00:00+0100",
      "coordx": 67,
      "coordy": 50,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    },
    {
      "id": 531,
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
      "date": "3019-03-04T00:00:00+0100",
      "coordx": 68,
      "coordy": 51,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    }
  ]
]
```
#### Check if a character was present during an event
```
> 127.0.0.1:8000/character/{slug}/event/{event}/present
```
> 127.0.0.1:8000/character/frodon/event/bataille-gouffre-helm/present

```javascript
[
  [
    {
      "id": 25,
      "slug": "bataille-gouffre-helm",
      "name": "Bataille du Gouffre de Helm. / Bataille de Fort-le-Cor",
      "date": "3019-03-03T00:00:00+0100",
      "date_end": "3019-03-04T00:00:00+0100",
      "coordx": 38,
      "coordy": 52
    }
  ],
  "error : frodon was not here during this period"
]
```
#### Get informations about some characters
```
> 127.0.0.1:8000/characters/?who={slug}
> 127.0.0.1:8000/characters/?who={slug}-{slug}
```
> 127.0.0.1:8000/characters?who=frodon-legolas-sam

```javascript
[
  [
    {
      "id": 3,
      "slug": "frodon",
      "name": "Frodon Sacquet",
      "race": {
        "id": 3,
        "slug": "hobbit",
        "description": "Egalement appelés Semi-hommes ou Periannath."
      }
    }
  ],
  [
    {
      "id": 6,
      "slug": "legolas",
      "name": "Legolas Vertefeuille, fils de Thranduil",
      "race": {
        "id": 2,
        "slug": "elfe",
        "description": "Les aînés des Enfants d'Ilúvatar, les cadets étant les Hommes."
      }
    }
  ],
  [
    {
      "id": 9,
      "slug": "sam",
      "name": "Samsagace Gamegie, dit Sam",
      "race": {
        "id": 3,
        "slug": "hobbit",
        "description": "Egalement appelés Semi-hommes ou Periannath."
      }
    }
  ]
]
```
#### Get informations about all characters for a date
```
> 127.0.0.1:8000/characters/date/{date}
```
> 127.0.0.1:8000/characters/date/3019-01-09

```javascript
[
  {
    "id": 109,
    "character": {
      "id": 1,
      "slug": "aragorn",
      "name": "Aragorn, dit Grands-Pas",
      "race": {
        "id": 1,
        "slug": "homme",
        "description": "L'humanité, race jeune en opposition aux autres races humanoïdes telles les Elfes, les Nains ou les Orques."
      }
    },
    "date": "3019-01-09T00:00:00+0100",
    "coordx": 44,
    "coordy": 32,
    "status": {
      "id": 1,
      "slug": "Bonne santé"
    }
  },
  {
    "id": 293,
    "character": {
      "id": 2,
      "slug": "boromir",
      "name": "Boromir, fils de Denethor",
      "race": {
        "id": 1,
        "slug": "homme",
        "description": "L'humanité, race jeune en opposition aux autres races humanoïdes telles les Elfes, les Nains ou les Orques."
      }
    },
    "date": "3019-01-09T00:00:00+0100",
    "coordx": 44,
    "coordy": 32,
    "status": {
      "id": 1,
      "slug": "Bonne santé"
    }
  },
  ...
]
```
#### Get informations about all characters during a period
```
> 127.0.0.1:8000/characters/period/{event}/{date}
```
> 127.0.0.1:8000/characters/period/conseil-elrond/3018-10-30

The result will take the same form as previously.
***
### Events
***
#### Get all events
```
> 127.0.0.1:8000/events
```
```javascript
[
  {
    "id": 1,
    "slug": "frodon-quitte-hobbitebourg",
    "name": "Frodon quitte Hobbitebourg",
    "date": "3018-09-23T00:00:00+0100",
    "date_end": "3018-09-23T00:00:00+0100",
    "coordx": 13,
    "coordy": 24
  },
  {
    "id": 2,
    "slug": "nazgul-atteint-hobbitebourg",
    "name": "Un Nazgûl atteint Hobbitebourg à la nuit tombée",
    "date": "3018-09-23T00:00:00+0100",
    "date_end": "3018-09-23T00:00:00+0100",
    "coordx": 13,
    "coordy": 24
  },
  {
    "id": 3,
    "slug": "attaque-nazgul-poney-fringant",
    "name": "À l'aube, attaque des Nazgûl sur le Creux-de-Crique et l'Auberge du Poney Fringant",
    "date": "3018-09-30T00:00:00+0100",
    "date_end": "3018-09-30T00:00:00+0100",
    "coordx": 26,
    "coordy": 26
  },
  ...
]
```
#### Get one event
```
> 127.0.0.1:8000/event/{slug}
```
> 127.0.0.1:8000/event/mort-de-boromir

```javascript
[
  {
    "id": 14,
    "slug": "mort-de-boromir",
    "name": "Mort de Boromir",
    "date": "3019-02-26T00:00:00+0100",
    "date_end": "3019-02-26T00:00:00+0100",
    "coordx": 54,
    "coordy": 49
  }
]
```
#### Get the characters' positions during an event
```
> 127.0.0.1:8000/event/{slug}/position/characters
```
> 127.0.0.1:8000/event/mort-de-boromir/position/characters

```javascript
[
  [
    {
      "id": 14,
      "slug": "mort-de-boromir",
      "name": "Mort de Boromir",
      "date": "3019-02-26T00:00:00+0100",
      "date_end": "3019-02-26T00:00:00+0100",
      "coordx": 54,
      "coordy": 49
    }
  ],
  [
    {
      "id": 157,
      "character": {
        "id": 1,
        "slug": "aragorn",
        "name": "Aragorn, dit Grands-Pas",
        "race": {
          "id": 1,
          "slug": "homme",
          "description": "L'humanité, race jeune en opposition aux autres races humanoïdes telles les Elfes, les Nains ou les Orques."
        }
      },
      "date": "3019-02-26T00:00:00+0100",
      "coordx": 54,
      "coordy": 49,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    },
    ...
  ]
]
```
#### Returns the character that were present during an event
```
> 127.0.0.1:8000/event/{slug}/present/characters
```
> 127.0.0.1:8000/event/attaque-nazgul-poney-fringant/present/characters

```javascript
[
  [
    {
      "id": 3,
      "slug": "attaque-nazgul-poney-fringant",
      "name": "À l'aube, attaque des Nazgûl sur le Creux-de-Crique et l'Auberge du Poney Fringant",
      "date": "3018-09-30T00:00:00+0100",
      "date_end": "3018-09-30T00:00:00+0100",
      "coordx": 26,
      "coordy": 26
    }
  ],
  [
    {
      "id": 560,
      "character": {
        "id": 4,
        "slug": "gandalf",
        "name": "Gandalf le gris, puis Gandalf le blanc",
        "race": {
          "id": 4,
          "slug": "maia",
          "description": "Ils font partie des Ainur, les divinités issues de l'esprit d'Ilúvatar, le dieu créateur."
        }
      },
      "date": "3018-09-30T00:00:00+0100",
      "coordx": 26,
      "coordy": 26,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    }
  ]
]
```
***
### Places
***
#### Get all places
```
> 127.0.0.1:8000/places
```
```javascript
[
  {
    "id": 1,
    "slug": "hobbitbourg",
    "name": "Hobbitbourg",
    "coordx": 13,
    "coordy": 24
  },
  {
    "id": 2,
    "slug": "bree",
    "name": "Bree",
    "coordx": 26,
    "coordy": 26
  },
  {
    "id": 3,
    "slug": "mont-venteux",
    "name": "Mont Venteux",
    "coordx": 32,
    "coordy": 26
  },
  ...
]
```
#### Get one place
```
> 127.0.0.1:8000/place/{slug}
```
> 127.0.0.1:8000/place/montagne-du-destin

```javascript
[
  {
    "id": 16,
    "slug": "montagne-du-destin",
    "name": "Montagne du Destin",
    "coordx": 75,
    "coordy": 58
  }
]
```
#### Returns all characters that went to a place
```
> 127.0.0.1:8000/place/{slug}/characters
```
> 127.0.0.1:8000/place/montagne-du-destin/characters

```javascript
[
  [
    {
      "id": 16,
      "slug": "montagne-du-destin",
      "name": "Montagne du Destin",
      "coordx": 75,
      "coordy": 58
    }
  ],
  [
    {
      "id": 552,
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
      "date": "3019-03-25T00:00:00+0100",
      "coordx": 75,
      "coordy": 58,
      "status": {
        "id": 5,
        "slug": "Croqué le doigt !"
      }
    },
    ...
  ]
]
```
#### Returns all characters that to went to a place for a given date
```
> 127.0.0.1:8000/place/{slug}/characters/date/{date}
```
> 127.0.0.1:8000/place/amon-hen/characters/date/3019-01-09

```javascript
[
  [
    {
      "id": 23,
      "slug": "amon-hen",
      "name": "Amon Hen",
      "coordx": 54,
      "coordy": 49
    }
  ],
  "error : nobody here at this date"
]
```
#### Returns all characters that went to a place during a period
```
> 127.0.0.1:8000/place/{slug}/characters/period/{date}/{event}
```
> 127.0.0.1:8000/place/hobbitbourg/characters/period/3018-09-23/bataille-gouffre-helm

```javascript
[
  [
    {
      "id": 1,
      "slug": "hobbitbourg",
      "name": "Hobbitbourg",
      "coordx": 13,
      "coordy": 24
    }
  ],
  [
    {
      "id": 369,
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
      "date": "3018-09-23T00:00:00+0100",
      "coordx": 13,
      "coordy": 24,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    },
    {
      "id": 559,
      "character": {
        "id": 4,
        "slug": "gandalf",
        "name": "Gandalf le gris, puis Gandalf le blanc",
        "race": {
          "id": 4,
          "slug": "maia",
          "description": "Ils font partie des Ainur, les divinités issues de l'esprit d'Ilúvatar, le dieu créateur."
        }
      },
      "date": "3018-09-29T00:00:00+0100",
      "coordx": 13,
      "coordy": 24,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    },
    {
      "id": 1473,
      "character": {
        "id": 9,
        "slug": "sam",
        "name": "Samsagace Gamegie, dit Sam",
        "race": {
          "id": 3,
          "slug": "hobbit",
          "description": "Egalement appelés Semi-hommes ou Periannath."
        }
      },
      "date": "3018-09-23T00:00:00+0100",
      "coordx": 13,
      "coordy": 24,
      "status": {
        "id": 1,
        "slug": "Bonne santé"
      }
    }
  ]
]
```
***
### Map
***
#### Get the map
```
> 127.0.0.1:8000/map
```