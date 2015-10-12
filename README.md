Framework.php
=============

 What is it?
------------
For control freaks with a deadline; Framework.php is a collection of classes which intends to provide any functionality you'd expect from a content managment system, but while still having complete control over how your project is implemented.

This framework is quick to implement, while still providing the necessary security and organization a PHP framework should have. This framework doesn't shape your website or application; instead, you can make use of its classes to any extent you like.

Framework.php has a while to go before it contains all the features that will make it awsome, so consider it as an open beta; drastic changes might occur at any time until it is complete.

What's inside?
--------------
At its core, Framework.php is just a fancy autoload script which keeps track of "include paths". It also contains some error handling features, which will soon be revised. (more information will be written here soon) Framework.php uses PHP's spl_register_autoload function so that it is compatible with other autoloaders, such as the one generated by Composer.

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
- Ability to be loaded with Composer

### Ideas for the future
No promises on any of these features, but these are some ideas of what could be implemented in Framework.php
- A repository of CDNs for including specific versions of Jquery, Bootstrap, etc very quickly.
- Add support for classes inside namespaces (some of them don't work and I'm not sure why)