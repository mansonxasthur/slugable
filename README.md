# Slugable
- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)

<a name="introduction"></a>
## Introduction
A package to add slug functionality to an Eloquent model.

 <a name="installation"></a>
 ## Installation
 Install the package through [Composer](http://getcomposer.org/). 
 
 Run the Composer require command from the Terminal:
 
     composer require mx13/slugable
     
     
  <a name="usage"></a>
  ## Usage
  - The Eloquent model should implement the `\MX13\Slugable\SlugInterface` contract which enforces
  implementing the `getSlugColumn()` method which returns the name of the slug column.
  - The Eloquent model should use `\MX13\Slugable\Slugable` trait which has all the functionality
  needed to make the Eloquent model slugable.