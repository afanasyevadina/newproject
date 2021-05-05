<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml">
<url>
  <loc>http://dinasyeva.beget.tech/</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>http://dinasyeva.beget.tech/en/projects</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en/projects" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es/projects" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru/projects" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://dinasyeva.beget.tech/en/blog</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en/blog" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es/blog" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru/blog" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://dinasyeva.beget.tech/en/login</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en/login" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es/login" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru/login" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://dinasyeva.beget.tech/en/register</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en/register" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es/register" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru/register" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://dinasyeva.beget.tech/en/profile</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en/profile" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es/profile" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru/profile" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
@foreach(App\User::all() as $user)
<url>
  <loc>http://dinasyeva.beget.tech/en/profile/{{ $user->slug }}</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en/profile/{{ $user->slug }}" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es/profile/{{ $user->slug }}" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru/profile/{{ $user->slug }}" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.64</priority>
</url>
@endforeach
@foreach(App\Article::all() as $article)
<url>
  <loc>http://dinasyeva.beget.tech/en/blog/{{ $article->slug }}</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en/blog/{{ $article->slug }}" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es/blog/{{ $article->slug }}" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru/blog/{{ $article->slug }}" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.51</priority>
</url>
@endforeach
@foreach(App\Project::all() as $project)
<url>
  <loc>http://dinasyeva.beget.tech/en/projects/{{ $project->slug }}</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://dinasyeva.beget.tech/en/projects/{{ $project->slug }}" />
  <xhtml:link rel="alternate" hreflang="es" href="http://dinasyeva.beget.tech/es/projects/{{ $project->slug }}" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://dinasyeva.beget.tech/ru/projects/{{ $project->slug }}" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.51</priority>
</url>
@endforeach
</urlset>