#! /usr/bin/env bash

# create a popcorn repo named after the given commit
git clone -q "clones/popcorn-js" "clones/${2}"

# move to the new git repo
cd "clones/${2}"

git remote add popcorn ${1}

# pull in our branch from the remote
git pull popcorn develop 

perl ../../../scripts/testswarm-popcorn-git.pl.txt ${2}
