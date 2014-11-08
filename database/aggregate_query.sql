select to_char(date_trunc('day', observationdate), 'YYYY-MM-DD') as day,  sum(precipitation) 
OVER (ORDER BY to_char(date_trunc('day', observationdate), 'YYYY-MM-DD'))
from rain
order by observationdate
