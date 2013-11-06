import datetime
import re
import urllib2
import weatherdb

'''David Graham 10/28/2013'''
'''Retrieves the wave height and direction in Hilo Bay'''

splitter=[]
#get current datetime in UTC (+10 hours)
dt = datetime.datetime.now() + datetime.timedelta(hours=10)
datest = dt.strftime("%Y%m%d")

url = 'http://cdip.ucsd.edu/cgi-bin/pm_download?station=188&year='+dt.strftime("%Y")+'&month='+dt.strftime("%m")+'&public=public&stream_label=p1'

req = urllib2.Request(url)
response = urllib2.urlopen(req)
the_page = response.read()

#split the url response into lines which gives us an array from which we then remove excess whitespace
lines = the_page.split('\n')
lines = [line.strip() for line in lines]

#the first four lines are headers and the last line is empty
for line in lines[4:-1]:
    splitter = re.split('\s+', line)
    obsdate = datetime.datetime(int(splitter[0]), int(splitter[1]), int(splitter[2]), int(splitter[3]), int(splitter[4]))
    wave_height = splitter[5]
    wave_direction = splitter[7]
    wave_period = splitter[6]
    weatherdb.SaveWaves(obsdate, wave_height, wave_direction, wave_period)
