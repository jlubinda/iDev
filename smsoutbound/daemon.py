import threading
import urllib2
import os


def do_every(interval, worker_func, iterations=0):
    if iterations != 1:
        threading.Timer(
            interval,
            do_every, [interval, worker_func, 0 if iterations == 0 else iterations - 1]
        ).start()

    worker_func()


def post_data():
    response = urllib2.urlopen('http://localhost/carrental/smsoutbound/sms_post_to_url.php')
    for line in response:
        print line.rstrip()


def periodic_search():
    response = urllib2.urlopen('http://localhost/carrental/smsoutbound/periodic_search.php')
    for line in response:
        print line.rstrip()
		

def clear_screen():
	os.system('cls')

	
do_every(4, post_data)

	
do_every(60, periodic_search)


do_every(3600, clear_screen)
