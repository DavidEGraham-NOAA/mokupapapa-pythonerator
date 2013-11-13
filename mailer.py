import smtplib
import sys

'''Sends an email through raw smtp'''
'''David Graham 11/13/2013'''
SMTP_SERVER = 'smtp.gmail.com'
SMTP_PORT = 587
SENDER = '<SENDER_ADDRESS>'
PASSWORD = '<SENDER_PASSWORD>'

def NotificationMail(recipient, subject, body):
    #print body
    recip = ",".join(recipient)
    body = "" + body + ""
    headers = ["From: " + SENDER,
           "Subject: " + subject,
           "To: " + recip,
           "MIME-Version: 1.0",
           "Content-Type: text/html"]
    headers = "\r\n".join(headers)
 
    try:
        session = smtplib.SMTP(SMTP_SERVER, SMTP_PORT)
        session.ehlo()
        session.starttls()
        session.ehlo
        session.login(SENDER, PASSWORD)
        session.sendmail(SENDER, recipient, headers + "\r\n\r\n" + body)
        session.quit()
        
    except Exception as e:
        print 'mailer.py send failure:' + str(repr(e))
