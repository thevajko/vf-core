# Vajko framework core library

! Currently still under development and testing !

This famework is used to demostrate web applicaiton based on MVC architecture. It is designed as educational resource,
therefore whole solution is very simple and minimaslistic. Framework contain very ritch commented source code. 

Base elements such as:
* Auto-class loading - You can use framework object or composers
* Booter - Whole application
* Router - Just parse URL and redirect call to controller
* Templating system - System used to create views. Templating system is just pure PHP output.  
* Simple error handling - Simple error output

Other elements such as DB, session handler, authentification, etc. must be implemented by developer itself. Framework 
do no use other third-party libraries, any meta-script generation or precompile, caching or other stuff
which for beginers looks like _magic_. Each request if __fully traceble__.

Library is ready to be used as [Composer](https://getcomposer.org/) package.

## Example application
More detail how to implement this library can be found on [Sandbox](https://github.com/thevajko/vf-sandbox) example 
application.



