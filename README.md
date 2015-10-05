Framework.php
=============

 What is it?
------------
Framework.php is a good PHP frameworks for control freaks with a deadline.

This framework is quick to implement, while still providing the necessary security and organization a PHP framework should have. This framework doesn't shape your website or application; instead, you can make use of its classes to any extend you like.

What's inside?
--------------
At its core, Framework.php is just a fancy autoload script which keeps track of "include paths". It also contains some error handling features, which will soon be revised. (more information will be written here soon)

### framework/internal
Contained in this folder are classes intended for use by Framework.php libraries. A notable class is the Router class, which provides MVC-style loading of PHP controllers for web pages. Some of the really cool classes in here will be documented soon.

### framework/lib
In this folder are some sample libraries that use Framework.php's capabilities. (kind of; admittedly they're rather out of date at the moment)

What's next?
------------
Right now this framework needs a bit of work before anybody can include this in their project and get going (mainly documentation). Here's the master TODO list that will determine this project's fate.
- Go through EVERYTHING, add Framework::AssertType calls to methods, and document methods
  - [DOC,MODIFY] AnonymousClass.class.php
  - [DOC,MODIFY] BaseController.class.php
  - [DOC,MODIFY] Configurator.class.php
  - [DOC,MODIFY] Controller.class.php
  - [DOC,MODIFY] DBConnectionManager.class.php
  - [DOC,MODIFY] Router.class.php
  - [DOC,MODIFY] Template.class.php
  - [DOC] VarTools.class.php
- Go through old files and determine if they're still needed
  - Templater.class.php (I don't even remember this one)
  - Registry.class.php (Don't think I used this for anything)
- Program some cool library that uses Framework.php's newer features

### Ideas for the future
No promises on any of these features, but these are some ideas of what could be implemented in Framework.php
- A repository of CDNs for including specific versions of Jquery, Bootstrap, etc very quickly.