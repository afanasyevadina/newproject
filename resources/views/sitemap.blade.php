<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml">
<url>
  <loc>http://new-project/</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>1.00</priority>
</url>
<url>
  <loc>http://new-project/en/projects</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en/projects" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es/projects" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru/projects" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://new-project/en/blog</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en/blog" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es/blog" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru/blog" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://new-project/en/login</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en/login" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es/login" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru/login" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://new-project/en/register</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en/register" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es/register" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru/register" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://new-project/en/profile</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en/profile" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es/profile" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru/profile" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.80</priority>
</url>
@foreach(App\User::all() as $user)
<url>
  <loc>http://new-project/en/profile/{{ $user->slug }}</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en/profile/{{ $user->slug }}" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es/profile/{{ $user->slug }}" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru/profile/{{ $user->slug }}" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.64</priority>
</url>
@endforeach
@foreach(App\Article::all() as $article)
<url>
  <loc>http://new-project/en/blog/{{ $article->slug }}</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en/blog/{{ $article->slug }}" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es/blog/{{ $article->slug }}" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru/blog/{{ $article->slug }}" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.51</priority>
</url>
@endforeach
@foreach(App\Project::all() as $project)
<url>
  <loc>http://new-project/en/projects/{{ $article->slug }}</loc>
  <xhtml:link rel="alternate" hreflang="en" href="http://new-project/en/projects/{{ $project->slug }}" />
  <xhtml:link rel="alternate" hreflang="es" href="http://new-project/es/projects/{{ $project->slug }}" />
  <xhtml:link rel="alternate" hreflang="ru" href="http://new-project/ru/projects/{{ $project->slug }}" />
  <lastmod>2020-11-23T11:20:18+00:00</lastmod>
  <priority>0.51</priority>
</url>
@endforeach
</urlset>