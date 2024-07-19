""" Faction Model Serializers. """

from rest_framework import serializers

from .models import Faction, Leader, Attendee


class FactionSerializer(serializers.ModelSerializer):
    class Meta:
        model = Faction
        fields = "__all__"


class LeaderSerializer(serializers.ModelSerializer):
    class Meta:
        model = Leader
        fields = "__all__"


class AttendeeSerializer(serializers.ModelSerializer):
    class Meta:
        model = Attendee
        fields = "__all__"
