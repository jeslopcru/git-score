# git-score

*git-score* is a script to compute some "scores" for committers in a git repo. Use it for fun or to brag about your involvement in the development of a project.

This script is inspired by [git-score](https://github.com/msparks/git-score), a python script

## Usage

![gif](http://imgur.com/gxA3Ezb.gif)

In a repository, type:

```sh
$ git-score
```

This will output something like the following:

```
+------------------------------+----------------------------------+---------+-------+-------+------+-------+
| name                         | email                            | commits | delta | (+)   | (-)  | files |
+------------------------------+----------------------------------+---------+-------+-------+------+-------+
| Antonio Laguna               | sombragriselros@gmail.com        | 125     | 4251  | 11871 | 7620 | 93    |
| José Luis Antúnez            | jlantunez@gmail.com              | 170     | 20817 | 26751 | 5934 | 51    |
| Luis                         | info@sentidodroid.com            | 15      | 226   | 1037  | 811  | 19    |
| Jeronimo López               | jerolba@gmail.com                | 1       | 0     | 1     | 1    | 2     |
| May Kittens Devour Your Soul | yoshimitsu002@gmail.com          | 2       | 1     | 2     | 1    | 3     |
| Felipe Valverde              | felipe.valverde.campos@gmail.com | 3       | 15    | 60    | 45   | 3     |
| ramon183                     | ramonroc@gmail.com               | 1       | 39    | 39    | 0    | 2     |
| Michael                      | synapsos@gmail.com               | 1       | 0     | 5     | 5    | 4     |
| martijn                      | martijn@plebian.nl               | 1       | 0     | 1     | 1    | 2     |
+------------------------------+----------------------------------+---------+-------+-------+------+-------+
```

## Installation

To install git-score, install Composer and issue the following command:

```sh
$ composer global require jeslopcru/git-score
```

Then make sure you have the global Composer binaries directory in your PATH. This directory is platform-dependent, see Composer documentation for details. Example for some Unix systems:

```sh
$ export PATH="$PATH:$HOME/.composer/vendor/bin"
```
