from __future__ import unicode_literals
from django.core.validators import MaxValueValidator, MinValueValidator
from django.db import models


# Create your models here.
class User(models.Model):
    first_name = models.CharField(max_length=32)
    last_name = models.CharField(max_length=64)
    want2read=models.ManyToManyField('Libry.Writing')
    age = models.PositiveIntegerField(null=True, validators=[
        MaxValueValidator(150),
        MinValueValidator(0)
    ])
    SEX_CHOICES = (
        ('M', 'Male'),
        ('F', 'Female')
    )
    sex = models.CharField(max_length=1, choices=SEX_CHOICES, null=True)
    contact = models.ForeignKey('Contact.Contact')
