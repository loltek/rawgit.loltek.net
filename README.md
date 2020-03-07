# rawgit.loltek.net
code behind https://rawgit.loltek.net

running on CloudFlare free-tier CDN, and using a combination of php to validate the url (that it's really a raw.githubusercontent.com link),
and using nginx to proxy-serve files 

(nginx is a very efficient proxy server using a asynchronous event-driven architecutre for concurrently serving requests, consuming significantly less system resources than... using Apache or PHP to do the same job)
