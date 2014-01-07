import datetime
import decimal
import urllib2
from bs4 import BeautifulSoup
import weatherdb
import mailer

'''Retrieves and saves rainfall data from the NWS'''

def cleantds(thetag):
    thetag = thetag.replace("<td>","")
    thetag = thetag.replace("<td align=\"right\">","")
    return thetag.replace("</td>", "")
    
def buildobsdate(now, hhmm):
    return datetime.datetime(now.year, now.month, now.day, int(cleantds(str(hhmm))[0:2]), int(cleantds(str(hhmm))[3:5]))
    
def buildobs(observation):
    if(observation == "" or observation == None):
        return 0.00
    else:
        return decimal.Decimal(observation)
        
notificationlist = [CSV_EMAIL_ADDRESSES_WITH_SINGLE_QUOTES]
try:
    #This is really sub-optimal as the only apparent data source is 
    #a horribly formatted html page from weather.gov. They have xml and rss feeds but they
    #don't seem to include the rainfall numbers. Oh well, we'll deal.
    req = urllib2.Request('http://w1.weather.gov/data/obhistory/PHTO.html')
    response = urllib2.urlopen(req)
    the_page = response.read()

    dt = datetime.datetime.now()
    soup = BeautifulSoup(the_page)

    #the 16th table cell in the data table has the last hour's precip
    #hacktastic way to find the right table for extracting the data
    #let's hope they don't change the markup very often on this page
    #for tag in soup.find_all(text=re.compile("<table cellspacing=\"3\" cellpadding=\"2\" border=\"0\" width=\"670\">")):
    #    print(tag)
    tables = soup.find_all("table")
    rows = tables[3].find_all("tr")
    cleanrows = []
    for r in rows:
        cell = r.find_all("td")
        if(len(cell) > 15):
            cleanrows.append(cell)

    #print cleanrows
    for r in cleanrows:
        #There surely is a better way to do this, but this is the quick and dirty
        #If we had some cleaner dates coming out of the data life would be simpler
        #print(cleantds(str(r[0])) + " " + cleantds(str(r[1])) + " " + cleantds(str(r[15])))
        obsdate = None
        #if day(dt) = r[0] then obsdate = today + r[1]
        if(int(cleantds(str(r[0]))) == dt.day):
            #today
            obsdate = buildobsdate(dt, r[1])
            weatherdb.SaveRain(obsdate, buildobs(cleantds(str(r[15])).strip()))
        elif(int(cleantds(str(r[0]))) == (dt - datetime.timedelta(days=1)).day):
            #yesterday
            obsdate = buildobsdate(dt - datetime.timedelta(days=1), r[1])
            weatherdb.SaveRain(obsdate, buildobs(cleantds(str(r[15])).strip()))
        elif(int(cleantds(str(r[0]))) == (dt - datetime.timedelta(days=2)).day):
            #day before
            obsdate = buildobsdate(dt - datetime.timedelta(days=2), r[1])
            weatherdb.SaveRain(obsdate, buildobs(cleantds(str(r[15])).strip()))
        elif(int(cleantds(str(r[0]))) == (dt - datetime.timedelta(days=3)).day):
            #3 days ago
            obsdate = buildobsdate(dt - datetime.timedelta(days=3), r[1])
            weatherdb.SaveRain(obsdate, buildobs(cleantds(str(r[15])).strip()))
        elif(int(cleantds(str(r[0]))) == (dt - datetime.timedelta(days=4)).day):
            #4 days ago
            obsdate = buildobsdate(dt - datetime.timedelta(days=4), r[1])
            weatherdb.SaveRain(obsdate, buildobs(cleantds(str(r[15])).strip()))

except Exception as e:
    msg = 'Processing error saving rain observations. See rain.py and mailx. URL requested was = ' + url
    mailer.NotificationMail(notificationlist, 'Weather Portal Error - rain', msg + ' - ' + str(repr(e)))
