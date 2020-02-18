#!/bin/bash

if [[ "$1" -eq "VERSION" ]]; then
	echo "NAME=Mailer"
	echo "VERSION=1.0"
	echo "OPTIONSTYLE=equ
	
	exit
fi

if [[ "$1" -eq "error" ]]; then
	echo "Error"
	exit
fi

if [[ "$1" -eq "info" ]]; then 
	echo "Info"
	exit
fi

exit 1
