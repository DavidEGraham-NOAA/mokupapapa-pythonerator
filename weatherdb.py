import psycopg2

'''David Graham 10/28/2013'''
'''Manages connections and other database functionality for Hilo Bay weather applications'''

#Connect to database
conn = psycopg2.connect("dbname=mokupapapa user=<USERNAME> password=<PASSWORD>")
cur = conn.cursor()

#Method for salinity measurement ingestion used by salinity.py
def SaveSalinity(observationdate, salinity, turbidity):
    cur.execute("""INSERT INTO turbidity (observationdate, salinity, turbidity) 
              SELECT %(obsdate)s, %(sal)s, %(turb)s
              WHERE NOT EXISTS (
                  SELECT * FROM turbidity WHERE observationdate = %(obsdate)s
              );""",
              {'obsdate': observationdate,
              'sal': salinity,
              'turb': turbidity})
    conn.commit()

#Method for river measurement ingestion used by river.py
def SaveRiver(observationdate, flowrate, height):
    cur.execute("""INSERT INTO river (observationdate, flowrate, height)
                 SELECT %(obsdate)s, %(flow)s, %(ht)s
                 WHERE NOT EXISTS (
                     SELECT * FROM river WHERE observationdate = %(obsdate)s
                 );""",
                 {'obsdate': observationdate,
                 'flow': flowrate,
                 'ht': height})
    conn.commit()

#Method for wind measurement ingestion used by wind.py
def SaveWind(observationdate, windspeed, winddirection):
    cur.execute("""INSERT INTO wind (observationdate, speed, direction)
                 SELECT %(obsdate)s, %(speed)s, %(dir)s
                 WHERE NOT EXISTS (
                     SELECT * FROM wind WHERE observationdate = %(obsdate)s
                 );""",
                 {'obsdate': observationdate,
                 'speed': windspeed,
                 'dir': winddirection})
    conn.commit()

#Method for wave measurement ingestion used by waves.py
def SaveWaves(observationdate, height, direction, period):
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

#Method for satellite image ingestion tracking used by satellite.py
def SaveSatellite(isold):
    cur.execute("""INSERT INTO satellite (newimage) VALUES (%(old)s);""",
               {'old': isold})
    conn.commit()

#Method for rainfall measurement ingestion used by rain.py
def SaveRain(observationdate, rainfall):
    cur.execute("""INSERT INTO rain (observationdate, precipitation)
                 SELECT %(obsdate)s, %(rain)s
                 WHERE NOT EXISTS (
                     SELECT * FROM rain WHERE observationdate = %(obsdate)s
                 );""",
                 {'obsdate': observationdate,
                 'rain': rainfall})
    conn.commit()
