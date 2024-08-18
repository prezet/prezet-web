---
title: Prezet + Bref + AWS Lambda for Lean Laravel Deployments
excerpt: Learn how to deploy a Laravel application with Prezet on AWS Lambda using Bref.sh, addressing common challenges and optimizations.
slug: bref
date: 2024-08-12
category: Deployment
image: /prezet/img/ogimages/deployment-bref.webp
---

Prezet integrates seamlessly with traditional server-based Laravel deployments, such as those managed through Laravel Forge. In fact, the whole point of Prezet is to consolidate your content and application into a single deployment.

However, running a dedicated application server 24/7 solely to host a handful of articles can be cost-prohibitive, especially if you don't already have a Laravel application server and/or Laravel Forge subscription available.

In such scenarios, deploying your Laravel application to a serverless environment like AWS Lambda can be a cost-effective solution, especially when paired with [Cloudflare Edge Cache](/deployment/cloudflare).

While configuring a Laravel application to run on AWS Lambda can be complex, [Bref](https://bref.sh/) makes it quick and easy.

## What is Bref?
 Bref is a free open source project that leverages the [Serverless Framework](https://www.serverless.com/) to quickly deploy PHP applications to AWS Lambda. It's designed to work seamlessly with popular PHP frameworks such as Symfony and Laravel.

## Configuring Bref for Prezet

The serverless framework relies on a `serverless.yml` file that defines the configuration for your application, such as the runtime, memory, environment variables, ancillary resources, etc. The framework then uses this file to scaffold all the necessary resources using AWS CloudFormation.

### 1. Publish the Serverless Config File
Prezet provides a command to publish a serverless.yml file that includes most of the configurations needed to deploy your application (except for the HTTPS Certificate). You can generate this file by running:

```bash
php artisan prezet:bref
```

This command performs the following actions:

1. Creates a serverless.yml file based on the Bref defaults, with additional Prezet-specific configurations:
   - Configures a CloudFront distribution to serve your application
   - Sets up an S3 bucket to store your blog content
   - Configures S3Sync to synchronize your content to the S3 bucket
   - Enables Binary Responses for dynamic image resizing
   - Adds the GD Extension layer for image manipulation

2. Installs the required PHP dependencies:
```bash
'composer require league/flysystem-aws-s3-v3 league/flysystem-read-only bref/bref bref/extra-php-extensions bref/laravel-bridge'
```

3. Installs the necessary Node.js dependencies:
```bash
npm install serverless-lift serverless-s3-sync
```

### 2. Issue an HTTPS certificate in ACM

Before deploying your application, you need to set up an HTTPS certificate for your domain. This can be done in the ACM (AWS Certificate Manager) by following [this link](https://us-east-1.console.aws.amazon.com/acm/home?region=us-east-1#/certificates/request). 

```html +parse
<x-prezet::alert
    type="info"
    body="Note that CloudFront requires certificates from us-east-1"
/>
```

Once the certificate has been issued you should Copy the certificate ARN into your serverless.yml file.

```yaml
constructs:
  website:
    domain: example.com
    certificate: arn:aws:acm:us-east-1:000000000000:certificate/00000000-0000-0000-0000-000000000000 # [tl! ++]
    type: server-side-website
    assets:
      '/build/*': public/build
      '/favicon.ico': public/favicon.ico
```

### 3. Serverless CLI Setup

If this is your first time using the Serverless Framework you need to install the Serverless CLI and add credentials for the AWS account you're deploying to. To do so follow the steps found in the [Bref documentation](https://bref.sh/docs/setup).

### 4. Deploy Your Application

With the Serverless CLI installed and your AWS credentials configured, you can deploy your application with the following command:

```html +parse
<x-prezet::alert
    type="warning"
    body="Remember to run artisan cache:clear before each deployment"
/>
```

```bash
serverless deploy
```

```html +parse
<x-prezet::alert
    type="info"
    body="Note that the first deployment will take 5-10 minutes due to CloudFront propagation. Let the command run until it's finished. Future deployments that do not modify CloudFront's configuration will take less then a minute."
/>
```

### 5. Update DNS Records

After deployment, the serverless framework will output information about the associated CloudFront distribution including its CNAME record. Here's an example output of the deployment for this very website:
```bash
...
functions:
  web: prezet-com-prod-web (39 MB)
  artisan: prezet-com-prod-artisan (39 MB)
website:
  url: https://prezet.com
  cname: d2ebm4fiptmrhs.cloudfront.net # [tl! ++]
```

The final step is to update your DNS records to point your domain to the CNAME record for the CloudFront distribution. You can do this by creating a CNAME record in your DNS provider.

## Automated Deployments

After your initial setup and getting everything in place, it's highly recommended to run your deployments in a GitHub Action or other CI/CD pipeline. This ensures that no locally cached views, routes, resources, etc., are pushed to production.

### Example GitHub Action

For reference take a look at the GitHub Action that's used to deploy this documentation on prezet.com: [github.com/.../.github/workflows/main.yml](https://github.com/prezet/prezet-web/blob/main/.github/workflows/main.yml)

### Required Secrets
To use this GitHub Action, you'll need to add the following secrets to your GitHub repository's environment:

- `AWS_ACCESS_KEY_ID`: Your AWS access key ID
- `AWS_SECRET_ACCESS_KEY`: Your AWS secret access key
- `CLOUDFLARE_ZONE`: Your Cloudflare zone ID
- `CLOUDFLARE_TOKEN`: Your Cloudflare API token

Make sure to set these secrets in your GitHub repository settings before running the action.

## Troubleshooting
If you experience a ERR_TOO_MANY_REDIRECTS error when using cloudflare make sure that your SSL/TLS encryption on Cloudflare is set to Full.


