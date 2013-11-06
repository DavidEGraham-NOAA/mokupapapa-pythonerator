import datetime
import decimal
import urllib2
import sys
from lxml import html
import weatherdb
import mailer

'''Retrieves the wind speed and direction'''
#get current datetime in UTC (+10 hours)
dt = datetime.datetime.now() + datetime.timedelta(hours=10)
datest = dt.strftime("%Y%m%d")
url = 'http://opendap.co-ops.nos.noaa.gov/axis/webservices/wind/response.jsp?stationId=1617760&beginDate='+datest+'&endDate='+datest+'&unit=Meters&timeZone=0&format=xml&Submit=Submit'
try:
    req = urllib2.Request(url)
    response = urllib2.urlopen(req)
    the_page = response.read()
    the_xml = html.parse(url)
    root = the_xml.xpath('.//data/*')
    lastelt = root[-1]
    timestamp = lastelt.findtext("timestamp")
    obsdate = datetime.datetime(int(timestamp[:4]), int(timestamp[5:7]), int(timestamp[8:10]), int(timestamp[11:13]), int(timestamp[14:16]))
    windspeed = decimal.Decimal(lastelt.findtext("ws"))
    winddir = int(lastelt.findtext("wd"))
    #IOError

except:
    mailer.NotificationMail(<EMAIL HERE>, 'Wind Ingester Error', sys.exc_info()[0])

else:
    try:
        weatherdb.SaveWind(obsdate, windspeed, winddir)
        #mailer.NotificationMail(<EMAIL HERE>, 'Wind Success', 'Wind success')

    except:
        mailer.NotificationMail(<EMAIL HERE>, 'Wind Database Save Error', sys.exc_info()[0])
