import smtplib
import sys

SMTP_SERVER = 'smtp.gmail.com'
SMTP_PORT = 587
SENDER = <SENDER_EMAIL_ADDRESS>
PASSWORD = <SENDER_PASSWORD>

def NotificationMail(recipient, subject, body):
    body = "" + body + ""
    headers = ["From: " + SENDER,
           "Subject: " + subject,
           "To: " + recipient,
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
    except:
        print 'mailer.py send failure:', sys.exc_info()[0]
