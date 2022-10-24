# README

Any file or directory that exists in the `src/public` folder is copied wholesale, unaltered, into the `web/dist` folder. Nothing in it is touched by Vite.

This is where you put any assets directly referenced inside CSS or HTML files. e.g., if you have a `screen.pcss` file and want to reference an image, you do it like this:

```css
html {
	background-image: url('/dist/images/test.png');
}
```
but you put the actual image itself in `src/public/images`.
