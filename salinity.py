import datetime
import decimal
import json
import urllib2
import weatherdb

'''David Graham 10/28/2013'''
'''Retrieves Hilo Bay salinity from PacIOOS'''

#get current datetime in UTC (+10 hours for HI) and build our request url
dt = datetime.datetime.now() + datetime.timedelta(hours=10)
dtstart = dt-datetime.timedelta(days=2)
endday = dt.strftime("%Y-%m-%d")
endtime = dt.strftime("%H:%M:%S")
startday = dtstart.strftime("%Y-%m-%d")
starttime = dtstart.strftime("%H:%M:%S")
url = 'http://oos.soest.hawaii.edu/erddap/tabledap/wqb04_agg.json?time,station_name,salinity,turbidity&time>='+startday+'T'+starttime+'Z&time<='+endday+'T'+endtime+'Z'

req = urllib2.Request(url)
response = urllib2.urlopen(req)
the_page = response.read()
the_json = json.loads(the_page)

#loop through our results and try to save each one
for elements in the_json['table']['rows'][0:len(the_json['table']['rows'])]:
    obsdate = datetime.datetime(int(elements[0][:4]), int(elements[0][5:7]), int(elements[0][8:10]), int(elements[0][11:13]), int(elements[0][14:16]))
    salinity = elements[2]
    turbidity = elements[3]
    weatherdb.SaveSalinity(obsdate, salinity, turbidity)
