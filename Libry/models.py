from __future__ import unicode_literals
from django.db import models
from django.core.validators import MaxValueValidator, MinValueValidator
from datetime import date
# Create your models here.
""" The App for Library, which create Books, Authors and etc. models"""


class Language(models.Model):
    language = models.CharField(max_length=16)


class Writing(models.Model):
    title = models.CharField(max_length=128)
    author = models.ManyToManyField('Author')
    release_year = models.IntegerField(
        # War and Peace year release :)
        default=1873,
        validators=[
            MaxValueValidator(2015),
            MinValueValidator(0)
        ]
    )
    page_num = models.PositiveSmallIntegerField()
    description = models.TextField()
    lang = models.ForeignKey(Language)
    lang_original = models.ForeignKey(Language, related_name='original')


class Author(models.Model):
    first_name = models.CharField(max_length=32)
    last_name = models.CharField(max_length=64)
    patronymic = models.CharField(max_length=64, null=True)
    year_born = models.IntegerField(
        default=1799,
        validators=[
            MaxValueValidator(2015),
            MinValueValidator(0)
        ]
    )
    year_death = models.IntegerField(null=True)
    # def check_death(self, year):
    #     if year >= Author.year_born:
    #         return True
    #     else:
    #         return False
    #
    # year_death = models.IntegerField(
    #     null=True,
    #     validators=[check_death(year_death),
    #                 MaxValueValidator(2015)
    #                 ]
    # )
    country = models.ForeignKey('Contact.Country', null=True)


class Book(models.Model):
    writing = models.ForeignKey('Writing')
    book_id=models.ManyToManyField('User.User')
    num = models.PositiveSmallIntegerField(
        default=0,
        validators={
            MaxValueValidator(16),
            MinValueValidator(0)
        }
    )
