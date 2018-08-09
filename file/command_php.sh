#!/bin/sh

while [ true ]
do
	cf=$(cat /run/script/command_php.txt)
	if [ "$cf" == "php7" ]
	then
		echo "" > /run/script/command_php.txt

		pid=$(ps -ef | grep '/usr/sbin/httpd' | grep -v grep | awk '{ print $1 }')
		for i in $pid
		do
			kill $i
		done

		apk del php5-apache2
		apk add php7-apache2

		/usr/sbin/httpd
	elif [ "$cf" == "php5" ]
	then
		echo "" > /run/script/command_php.txt

		pid=$(ps -ef | grep '/usr/sbin/httpd' | grep -v grep | awk '{ print $1 }')
		for i in $pid
		do
			kill $i
		done

		apk del php7-apache2
		apk add php5-apache2
		
		/usr/sbin/httpd
	else
		sleep 10
		#echo "$cf"
	fi
done


