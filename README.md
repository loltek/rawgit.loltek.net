# rawgit.loltek.net
Code behind https://rawgit.loltek.net

Running on CloudFlare free-tier CDN, and using a combination of PHP to validate the URL (that it's really a raw.githubusercontent.com link),
and using nginx to proxy-serve files.

(nginx is a very efficient proxy server using an asynchronous event-driven architecture for concurrently serving requests, consuming significantly less system resources than... using Apache or PHP to do the same job.)
