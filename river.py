import datetime
import json
import urllib2
import weatherdb

'''Retrieves the Wailuku River flow in ft^3/s'''
req = urllib2.Request("http://waterservices.usgs.gov/nwis/iv/?format=json&sites=16704000&parameterCd=00060")
response = urllib2.urlopen(req)
the_page = response.read()
the_json = json.loads(the_page)
river_flow = the_json["value"]["timeSeries"][0]["values"][0]["value"][0]["value"]

'''Retrieves the Wailuku River height in feet'''
req = urllib2.Request("http://waterservices.usgs.gov/nwis/iv/?format=json&sites=16704000&parameterCd=00065")
response = urllib2.urlopen(req)
the_page = response.read()
the_json = json.loads(the_page)
river_height = the_json["value"]["timeSeries"][0]["values"][0]["value"][0]["value"]

#log the_page
#print(the_page)

#calculate the response timestamp from the time
datestring = the_json["value"]["timeSeries"][0]["values"][0]["value"][0]["dateTime"]
obsdate = datetime.datetime(int(datestring[:4]), int(datestring[5:7]), int(datestring[8:10]), int(datestring[11:13]), int(datestring[14:16]), int(datestring[17:19]))

weatherdb.SaveRiver(obsdate, river_flow, river_height)

#check the database to see if this entry has already been entered.
#if so, do nothing, if not, insert the observation
#print(river_flow)
#print(the_page)
