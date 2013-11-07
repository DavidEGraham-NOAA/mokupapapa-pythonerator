import psycopg2
import mailer

'''David Graham 10/28/2013'''
'''Manages connections and other database functionality for Hilo Bay weather applications'''

#Connect to database
conn = psycopg2.connect("dbname=<DBNAME> user=<DBUSER> password=<DBPASSWORD>")
cur = conn.cursor()
notificationlist = ['<EMAIL1>','<EMAIL2'...]

#Method for salinity measurement ingestion used by salinity.py
def SaveSalinity(observationdate, salinity, turbidity):
    try:
        cur.execute("""INSERT INTO turbidity (observationdate, salinity, turbidity) 
                  SELECT %(obsdate)s, %(sal)s, %(turb)s
                  WHERE NOT EXISTS (
                      SELECT * FROM turbidity WHERE observationdate = %(obsdate)s
                  );""",
                  {'obsdate': observationdate,
                  'sal': salinity,
                  'turb': turbidity})
        conn.commit()

    except:
        mailer.NotificationMail(notificationlist, 'Weather Portal Error - salinity', 'Database error saving salinity/turbidity observations. See salinity.py, weatherdb.py and mailx.')

#Method for river measurement ingestion used by river.py
def SaveRiver(observationdate, flowrate, height):
    try:
        cur.execute("""INSERT INTO river (observationdate, flowrate, height)
                     SELECT %(obsdate)s, %(flow)s, %(ht)s
                     WHERE NOT EXISTS (
                         SELECT * FROM river WHERE observationdate = %(obsdate)s
                     );""",
                     {'obsdate': observationdate,
                     'flow': flowrate,
                     'ht': height})
        conn.commit()

    except:
        mailer.NotificationMail(notificationlist, 'Weather Portal Error - river', 'Database error saving river observations. See river.py, weatherdb.py and mailx.')

#Method for wind measurement ingestion used by wind.py
def SaveWind(observationdate, windspeed, winddirection):
    try:
        cur.execute("""INSERT INTO wind (observationdate, speed, direction)
                     SELECT %(obsdate)s, %(speed)s, %(dir)s
                     WHERE NOT EXISTS (
                         SELECT * FROM wind WHERE observationdate = %(obsdate)s
                     );""",
                     {'obsdate': observationdate,
                     'speed': windspeed,
                     'dir': winddirection})
        conn.commit()

    except:
        mailer.NotificationMail(notificationlist, 'Weather Portal Error - wind', 'Database error saving wind observations. See wind.py, weatherdb.py and mailx.')

#Method for wave measurement ingestion used by waves.py
def SaveWaves(observationdate, height, direction, period):
    try:
        cur.execute("""INSERT INTO waves (observationdate, height, direction, period)
                     SELECT %(obsdate)s, %(ht)s, %(dir)s, %(per)s
                     WHERE NOT EXISTS (
                         SELECT * FROM waves WHERE observationdate = %(obsdate)s
                     );""",
                     {'obsdate': observationdate,
                     'ht': height,
                     'dir': direction,
                     'per': period})
        conn.commit()

    except:
        mailer.NotificationMail(notificationlist, 'Weather Portal Error - waves', 'Database error saving wave observations. See waves.py, weatherdb.py and mailx.')

#Method for satellite image ingestion tracking used by satellite.py
def SaveSatellite(isold):
    cur.execute("""INSERT INTO satellite (newimage) VALUES (%(old)s);""",
               {'old': isold})
    conn.commit()

#Method for rainfall measurement ingestion used by rain.py
def SaveRain(observationdate, rainfall):
    try:
        cur.execute("""INSERT INTO rain (observationdate, precipitation)
                     SELECT %(obsdate)s, %(rain)s
                     WHERE NOT EXISTS (
                         SELECT * FROM rain WHERE observationdate = %(obsdate)s
                     );""",
                     {'obsdate': observationdate,
                     'rain': rainfall})
        conn.commit()

    except:
        mailer.NotificationMail(notificationlist, 'Weather Portal Error - rain', 'Database error saving rain observations. See rain.py, weatherdb.py and mailx.')
