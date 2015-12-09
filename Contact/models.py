from __future__ import unicode_literals
from django.core.validators import validate_email
from django.db import models


# Create your models here.
class Country(models.Model):
    country = models.CharField(max_length=32)


class City(models.Model):
    city = models.CharField(max_length=32, null=True)
    country = models.ForeignKey('Country')


class Address(models.Model):
    street = models.CharField(max_length=32, null=True)
    building = models.PositiveSmallIntegerField(null=True)
    appartment = models.PositiveSmallIntegerField(null=True)
    city = models.ForeignKey('City')


class Contact(models.Model):
    address = models.ForeignKey('Address')
    phone = models.PositiveSmallIntegerField()
    email = models.CharField(max_length=32, validators=[
        validate_email
    ])
