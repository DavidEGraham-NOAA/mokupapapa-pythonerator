import datetime
import json
import urllib2
import weatherdb
import mailer

'''David Graham 10/28/2013'''
notificationlist = []
try:
    '''Retrieves the Wailuku River flow in ft^3/s'''
    url = urllib2.Request("http://waterservices.usgs.gov/nwis/iv/?format=json&sites=16704000&parameterCd=00060")
    response = urllib2.urlopen(url)
    the_page = response.read()
    the_json = json.loads(the_page)
    river_flow = the_json["value"]["timeSeries"][0]["values"][0]["value"][0]["value"]

    '''Retrieves the Wailuku River height in feet'''
    url = urllib2.Request("http://waterservices.usgs.gov/nwis/iv/?format=json&sites=16704000&parameterCd=00065")
    response = urllib2.urlopen(url)
    the_page = response.read()
    the_json = json.loads(the_page)
    river_height = the_json["value"]["timeSeries"][0]["values"][0]["value"][0]["value"]

    #calculate the response timestamp from the time
    datestring = the_json["value"]["timeSeries"][0]["values"][0]["value"][0]["dateTime"]
    obsdate = datetime.datetime(int(datestring[:4]), int(datestring[5:7]), int(datestring[8:10]), int(datestring[11:13]), int(datestring[14:16]), int(datestring[17:19]))

    weatherdb.SaveRiver(obsdate, river_flow, river_height)

except Exception as e:
    msg = 'Processing error saving river observations. See river.py and mailx. URL requested was = ' + url
    mailer.NotificationMail(notificationlist, 'Weather Portal Error - river', msg + ' - ' + str(repr(e)))
