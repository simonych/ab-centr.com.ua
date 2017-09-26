
# If post..

---

Use `[if]` to display content based on post conditions.

~~~
[if category=recommend]
  Must watch!
[/if]
~~~

&nbsp;

## Parameters

### Post

> **type** - post type

> **name** - post name/slug

> **author** - post author ID or user name; set to *this* for current user

> **comment_author** - comment by author ID or name; use inside comments loop

> **parent** - slug or ID of parent

> **format** - post format; if no value is set, checks if any post format exists

### Category, tag, taxonomy

> **category** - if post is in category

> **tag** - if post has tag(s)

> **taxonomy** - name of taxonomy to query

> **term** - if post has specific taxonomy term(s); if no term is set, checks if any term exists


### Field value

> **field** - name of field to query

> **value** - if post has value(s) in the specified field; if no value is set, it will check if any field value exists

> **start** - use instead of **value** to check only the beginning of field value

> **lowercase** - set to *true* to compare lowercased version of field value

> **empty** - set to *false* when using dynamic values which could be empty, for example, with `[pass]`


### Date field

~~~
[if field=date value=today]..[/if]
[if field=date before='1 week ago']..[/if]
~~~

> **value=today** - if field value is today

> **before**/**after** - if field value is before/after a relative or specific date: *10 days*, *2 weeks ago*, or *2015-02-01*


### User field

> **user_field** - name of user field to query

> **value, start, compare** - see above for field value



### Multiple values

For category, tag, taxonomy, field, user field, or post format, you can query for multiple values.

*Science fiction **or** comedy*

~~~
[if category=sci-fi,comedy]
~~~

*Science fiction **and** comedy*

~~~
[if category=sci-fi,comedy compare=and]
~~~


### If it exists

~~~
[if attached]
  There are attachments.
[/if]
~~~

> **attached** - if the post has any attachments

> **comment** - if the post has any comments

> **image** - if the post has a featured image

> **sticky** - if post is sticky

> **gallery** - if the post has any image in the gallery field

> **field** - if the post has any value in this field

> **field=excerpt** - if the post has excerpt

> **taxonomy** - if the post has any term in this taxonomy


### Loop conditions

Use these inside the loop.

~~~
[if empty]Nothing found[/if]
[if first]First post[/if]
[if last]Last post[/if]
[if every=3]Every 3 posts[/if]
[if count=3 compare=more]After 3rd post[/if]
~~~

> **empty** - if the loop is empty

> **first, last** - if it's the first or last post found

> **count** - check current loop count; optionally set *compare* parameter: *more*, *less*, `>=`, `<=`

> **every** - for every number of posts in the loop; set *first* or *last* to *true* to include first/last post

>> This can be used, for example, to group four posts at a time.
>>
>> ~~~
>> [loop type=post]
>>   [if every=5 first=true]<div class="group-container">[/if]
>>   [field thumbnail]
>>   [field title]
>>   [if every=4 last=true]</div>[/if]
>> [/loop]
>> ~~~


### Passed value

> **pass** - the value being passed: *pass='{FIELD}'*

> **value** - the value to check: *value=this*

### Not

> **not** - when the condition is not true, for example: `[if not first]`


## Else

Use `[else]` to display something when the condition is false.

~~~
[if tag=discount]
  On Sale!
[else]
  Regular Price
[/if]
~~~

## Date field


You can use the parameters *before* and *after* to compare dates.

*If post was published in the last 2 weeks*

~~~
[if field=date after='2 weeks ago']
  New post
[else]
  Old post
[/if]
~~~

The value can be a specific date like *2015-02-01*, or a relative date such as *1 month ago*.

## Other conditions

### If a field value exists

To check if a field has any value, use the *field* parameter without specifying a value.

*Display only products that have serial numbers*

~~~
[loop type=product]
  [if field=serial_number]
    Product: [field title]
    Serial #: [field serial_number]
  [/if]
[/loop]
~~~

If you specify the *value* parameter, it will check for that specific value only.



### If a taxonomy term exists

To check if there's any term in a given taxonomy, use the *taxonomy* parameter without specifying a term.

*Display tags if any exists*

~~~
[loop type=book]
  Book: [field title]
  Author: [field author_name]
  [if taxonomy=tag]
    Tags:
    [for each=tag trim=true]
      [each name-link],
    [/for]
  [else]
    There's no tag.
  [/if]
[/loop]
~~~

## Nested


For nested conditions, use the minus prefix.

~~~
[loop type=product]
  [if category=books]
    The book [field title-link] is
    [-if field=status value=in-stock]
      in stock.
      [-else]
      not available.
    [/-if]
  [else]
    [field title-link] is not a book.
  [/if]
[/loop]
~~~

You can add up to 3 prefixes.
