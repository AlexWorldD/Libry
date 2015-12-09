from __future__ import unicode_literals

from django.db import models


# Create your models here.
class Rental(models.Model):
    book = models.ForeignKey('Libry.Book')
    from_user = models.ForeignKey('User.User', related_name='from_user')
    to_user = models.ForeignKey('User.User', related_name='to_user')
    rental_date = models.DateField()
    return_date = models.DateField(null=True)
