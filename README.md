# HaOS
A web based OS designed for quick application development and project deployment

## Introduction
HaOS is a web based operating system designed to allow many users to concurrently interact with the OS. This is achived using the following core technologies:
1. The jObject framework which provides a suite of gui html JS objects.
2. HaServer, a socket based server which allows realtime* communication on local networks.
3. HaBash, the custom language which are shared over the communication server to control the jObjects. 
4. jKernal, the brain with which commands are parsed and server communications are handled.

## jObject
jObject is a set of JS objects which abstract custom html dom objects and the associated events.
The following jObjects currently exist:
### Background
initializes a background for the OS.
```javascript
var bg = new Background('bg');
bg.setColor('green'); //set the color of the background
```
### Bar
Initializes a side bar on either the top,bottom,left,right side of the background.
```javascript
var bottom_bar = new Bar_bottom('bottom');
var top_bar = new Bar_top('top');
var left_bar = new Bar_left('left');
var right_bar = new Bar_right('right');

bottom_bar.setColor('red'); //set sidebar color

```
### Terminal
Creates a terminal object which interacts directly with the jKernal.
```javascript
var terminal = new Terminal('terminal');

terminal.drag(mouseX,mouseY); //takes in the users mouse coordinates and drags the terminal appropriately
terminal.stopdrag(mouseX,mouseY); //closes the draging process 

terminal.resize(mouseX,mouseY); //resizes the mouse based off mouse coordinates
terminal.stopresize(mouseX,mouseY); //stops resizing process
```
### Form

## HaServer
waiting for full documentation
## haBash
The command based language which controls all communication and OS interaction.
All commands are in the form:
```
[command] $ [object id] : [user id] | [parameters]
```
For example, the initialization of HaOS found in jKernal/bin looks like
```
init $HaOS | Background;
init $startbar | Bar_left;
setColor $HaOS | #b7d2ff;
setColor $ startbar | #669fff;
begin | newSession;
```
