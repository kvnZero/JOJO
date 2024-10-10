<h1 align="center" style="text-align:center;">
  JOJO
</h1>

<p align="center">JOJO is wordpress theme, you can enable it manage and show you company job offer</p>

## How To Install

> Tips: Create a new website to deploy this system.

1. Install WordPress and deploy it;
2. Download "JOJO" theme and "WPJAM Basic" plugin;
3. Upload "JOJO" in you WordPress "Themes" folder;
4. Upload "WPJAM Basic" in you WordPress "Plugins" folder;
5. Go to your Wordpress dashboard and go "Plugins" menu select "WPJAM Basic" plugin;
6. Go "Theme" menu select "JOJO" theme;
7. Go "Job" > "Job Taxonomy" menu and click "init" in page header;
8. Go "Theme" > "JOJO" config something;
9. Go "Job" menu insert you job offer;
10. Done!


### Fast Preview In You Local For Docker

I ready a dockerfile for you, you can use it fast deploy a wordpress system, in build time it download require plugin and opcache/memcached config (there will reduced response time).

Now, you can open terminal and run:

```shell
git clone git@github.com:kvnZero/JOJO.git
cd JOJO
docker build -t jojo:dev .
docker run -name jojo -p 8080:80 jojo:dev
```

And you can open http://localhost:8080 to wordpress and install it.
