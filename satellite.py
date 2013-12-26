import hashlib
import os
import urllib2
import mailer

#req = urllib2.Request("http://www.prh.noaa.gov/hnl/graphics/gtwo_gsat.gif")
req = urllib2.Request("http://www.ssd.noaa.gov/goes/west/hi/rb-l.jpg")
response = urllib2.urlopen(req)
#BASE_DIR = '/home/dgraham/Documents/'
BASE_DIR = '/var/www/html/mokupapapa/weather/'
output = open(BASE_DIR + 'new_file.jpg','wb')
output.write(response.read())
output.close()
#IOError:
newmd5 = hashlib.md5(open(BASE_DIR + 'new_file.jpg').read()).hexdigest()
#print(str(newmd5))

oldmd5 = hashlib.md5(open(BASE_DIR + 'sat_img.jpg').read()).hexdigest()
#print(str(oldmd5))

if(newmd5 != oldmd5):
    os.remove(BASE_DIR + 'sat_img.jpg')
    os.rename(BASE_DIR + 'new_file.jpg', BASE_DIR + 'sat_img.jpg')
    mailer.NotificationMail([''], 'New Satellite Image', 'Got a new satellite image')
else:
    os.remove(BASE_DIR + 'new_file.jpg')
    mailer.NotificationMail([''], 'Old Satellite Image', 'Got an old satellite image')
