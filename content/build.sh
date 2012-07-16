#!/bin/bash -x

if [ "$3" == "popcorn-js" ]
then
	echo "popcorn-js!"
	# create a popcorn repo named after the given commit
	git clone -q "clones/popcorn-js" "clones/${2}"

	# move to the new git repo
	cd "clones/${2}"

	git submodule update --init --recursive

	git remote add popcorn $1

	# pull in our branch from the remote
	git pull popcorn $4

	perl ../../../scripts/addjob/testswarm-popcorn-git.pl $2 $4
elif [ "$3" == "butter" ]
then
	# create butter repo named after the given commit
	git clone -q "clones/butter" "clones/${2}"

	# move to repo
	cd "clones/${2}"

	git submodule update --init --recursive

	git remote add butter $1

	git pull butter $4

	perl ../../../scripts/addjob/testswarm-butter-git.pl $2 $4
fi
