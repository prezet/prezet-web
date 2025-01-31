---
title: Efficiently Adding Google Analytics
excerpt: Learn how to add Google Analytics to your Prezet site without impacting page speed using Cloudflare Zaraz.
date: 2024-08-30
category: Deployment
image: /prezet/img/ogimages/deployment-analytics.webp
---

Maintaining search engine rankings is often crucial for content-rich applications. Prezet provides excellent on-page SEO by adding [meta tags](/features/seo) to the header and responsively [optimizing images](/features/images).

These steps combine to give high [PageSpeed](https://pagespeed.web.dev/) scores and lightning-fast page loads, especially when paired with [Cloudflare's Edge Cache](/deployment/cloudflare).

However, when you add heavy third-party tools like Google Analytics, it can negatively impact your site's PageSpeed score. Thankfully, [Cloudflare Zaraz](https://www.cloudflare.com/application-services/products/zaraz/) offers an elegant solution.

## What is Cloudflare Zaraz?

Zaraz is a Cloudflare service that allows you to load third-party tools, including Google Analytics, without impacting your PageSpeed scores. It offers a generous free tier and is available to both free and paid Cloudflare accounts.


```html +parse
<x-prezet::alert
    type="info"
    body="The Zaraz free tier includes 1,000,000 Zaraz events / month and is priced at $5.00 for each 1,000,000 events above the included amount."
/>
```

What's more, setting up Google Analytics with Zaraz doesn't require any changes to your application's code.

## Setting Up Google Analytics with Cloudflare Zaraz

Here's a step-by-step guide to set up Google Analytics using Cloudflare Zaraz:

1. **Access Zaraz in the Cloudflare Dashboard**
    - Log into your Cloudflare account and select your website.
    - In the left sidebar, scroll down and click on "Zaraz".

2. **Add Google Analytics as a New Tool**
    - On the Zaraz page, click the "Add new tool" button.
    - Select "Google Analytics 4" from the list of available tools.

3. **Configure Google Analytics**
    - You'll be presented with a setup wizard. Fill out the information on each screen.
    - Note that you'll need to enter your Google Analytics 4 Measurement ID (it should start with "G-").
  
![](analytics-20240830104656710.webp)
That's it! Cloudflare will now load the Google Analytics script away from your user's browser, allowing you to track your site's analytics without impacting your page load times or PageSpeed scores.
