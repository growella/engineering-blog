# Engineering @ Growella

This repository contains the source code behind [the Engineering @ Growella blog](https://engineering.growella.com).

The site itself [runs on WordPress](https://wordpress.org), using a custom child theme on top of TwentySeventeen. Project dependencies (themes, plugins, and even WordPress itself) are managed through [Composer](https://getcomposer.org), by way of [WPackagist](https://wpackagist.org/).


## Installation

If you would like to set up your own copy of the site, you may do so in three easy steps:

1. Clone this repository to your local machine:

		$ git clone https://github.com/growella/engineering-blog.git

2. Create your local environment, using the `docker-compose.yml` file in the repository ([requires Docker](https://www.docker.com/))

		$ docker-compose up

3. Configure WordPress — since this repository doesn't ship with a copy of the Engineering @ Growella database, your environment will be a fresh WordPress installation and [will require the regular setup](https://codex.wordpress.org/Installing_WordPress#Famous_5-Minute_Install).


## License

Copyright 2017 Growella

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.