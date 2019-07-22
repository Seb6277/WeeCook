[![Build Status](https://travis-ci.org/Seb6277/weecook.svg?branch=master)](https://travis-ci.org/Seb6277/weecook)
[![codecov](https://codecov.io/gh/Seb6277/weecook/branch/master/graph/badge.svg)](https://codecov.io/gh/Seb6277/weecook)

#Installation
You need to run PHP 7.2 with composer and NodeJS with npm to run this project.

First Fork the repository and retrieve it with `git clone` command line.

##Install php dependency
This project use the symfony/website-skeleton so use 

`composer install`

to install symfony and required dependency.

##install NodeJS dependency
CSS are preprocessed with SASS, some JS component are React component.
All of this stuff use webpack and other.

Run : `npm install`

##Compiling the assets
Now you have to run compilation of JS script and SASS

`npm run dev`

##Take a look
You can use the internal PHP server with the following command

`php bin/console server:run`