# LifeRaft Code Test

A jumpstart for the LifeRaft code test

## Getting started

This repository is intended to act as a starting point for your code test. Fork this repo, then flesh it out with your own code.
```
git clone https://gitlab.com/steve.day/liferaft-code-test.git
git remote add upstream https://somegithost.com/yourrepopath
```
(Replace `https://somegithost.com/yourrepopath` with the URL to an empty repo you create)

You can make any changes to what is provided that you see fit. This entire repo is intended as a convenience. You are not *required* to use it.

## Add your files
The `./API` folder is where you will write the **server** portion of the code test. `./UI` will store the **React** portion.

## Run with Docker
To run your project, simply run `docker-compose up` in your terminal. Press `Ctrl+C` to stop it.

The `Dockerfile`s are already configured to perform an `npm install` during the build process, then `npm start` to run your code. You will need to edit the `start` command in each `package.json` file to suit your needs.

## Replace this file
It's a good idea to replace this file with your own `README.md` describing anything we might need to know about running your app.

## Support
There's nothing wrong with asking for help. If you need any clarification on how to use this repo or the test details themselves, please reach out to us for assistance.