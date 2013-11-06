import hashlib
import os
import urllib2
import mailer

req = urllib2.Request("http://www.prh.noaa.gov/hnl/graphics/gtwo_gsat.gif")
response = urllib2.urlopen(req)
BASE_DIR = '/home/dgraham/Documents/'
output = open(BASE_DIR + 'new_file.gif','wb')
output.write(response.read())
output.close()
#IOError:
newmd5 = hashlib.md5(open(BASE_DIR + 'new_file.gif').read()).hexdigest()
#print(str(newmd5))

oldmd5 = hashlib.md5(open(BASE_DIR + 'gtwo_gsat.gif').read()).hexdigest()
#print(str(oldmd5))

if(newmd5 != oldmd5):
    os.remove(BASE_DIR + 'gtwo_gsat.gif')
    os.rename(BASE_DIR + 'new_file.gif', BASE_DIR + 'gtwo_gsat.gif')
    mailer.NotificationMail(<EMAIL>, 'New Satellite Image', 'Got a new satellite image')
else:
    os.remove(BASE_DIR + 'new_file.gif')
    #mailer.NotificationMail(<EMAIL>, 'Old Satellite Image', 'Got an old satellite image')
